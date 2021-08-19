import { useEffect, useMemo, useState } from 'react'
import { useLazyQuery } from '@apollo/client'
import { GET_ALL_FILE_PATH } from '../../queries/file'
import {
  GetAllFilePathQuery,
  GetAllFilePathQueryVariables,
} from '../../generated/graphql'
import { makeTree } from '../../utils/tree'

const useFilePath = ({ projectId }) => {
  const [page] = useState<number>(1)
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
    if (!data || !data.getAllFilePath.data) {
      return []
    }
    return data.getAllFilePath.data
      .filter((filePath) => filePath.depth === 0)
      .map((filePath) => {
        return makeTree(data.getAllFilePath.data, filePath, 0)
      })
  }, [data])

  return {
    called,
    loading,
    data,
    tree,
  }
}

export default useFilePath
