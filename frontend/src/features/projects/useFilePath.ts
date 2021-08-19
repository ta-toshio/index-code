import { useLazyQuery } from '@apollo/client'
import { GET_ALL_FILE_PATH } from '../../queries/file'
import {
  GetAllFilePathQuery,
  GetAllFilePathQueryVariables,
} from '../../generated/graphql'
import { useEffect, useMemo, useState } from 'react'

const makeTree = (allFilePath, filePath, depth: number) => {
  if (!filePath.is_dir) {
    return {
      key: filePath.file_path,
      label: filePath.name,
    }
  }

  const childNodes = allFilePath.filter(
    (_filePath) => _filePath.parent_id == filePath.id
  )
  if (!childNodes.length) {
    return {
      key: filePath.file_path,
      label: filePath.name,
    }
  }

  return {
    key: filePath.file_path,
    label: filePath.name,
    nodes: childNodes.map((_filePath) =>
      makeTree(allFilePath, _filePath, depth + 1)
    ),
  }
}

const useFilePath = ({ projectId }) => {
  const [page, setPage] = useState<number>(1)
  const [fetchFilePath, { called, loading, data }] = useLazyQuery<
    GetAllFilePathQuery,
    GetAllFilePathQueryVariables
  >(GET_ALL_FILE_PATH)

  useEffect(() => {
    if (projectId) {
      fetchFilePath({ variables: { projectId: +projectId, page } })
    }
  }, [fetchFilePath, page, projectId])

  const tree = useMemo(() => {
    if (data && data.getAllFilePath.data) {
      return data.getAllFilePath.data
        .filter((filePath) => filePath.depth === 0)
        .map((filePath) => {
          return makeTree(data.getAllFilePath.data, filePath, 0)
        })
    }
    return []
  }, [data])

  return {
    called,
    loading,
    data,
    tree,
  }
}

export default useFilePath
