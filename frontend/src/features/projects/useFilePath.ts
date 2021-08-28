import { useEffect, useMemo, useState } from 'react'
import { useLazyQuery } from '@apollo/client'
import { GET_ALL_FILE_PATH_BY_PROJECT_NAME } from '../../queries/file'
import {
  GetAllFilePathByProjectNameQuery,
  GetAllFilePathByProjectNameQueryVariables,
} from '../../generated/graphql'
import { makeTree } from '../../utils/tree'

type Props = {
  projectName: string | undefined
}

const useFilePath = ({ projectName }: Props) => {
  const [page] = useState<number>(1)
  const [fetchFilePath, { called, loading, data }] = useLazyQuery<
    GetAllFilePathByProjectNameQuery,
    GetAllFilePathByProjectNameQueryVariables
  >(GET_ALL_FILE_PATH_BY_PROJECT_NAME)

  useEffect(() => {
    if (projectName) {
      fetchFilePath({ variables: { projectName: projectName, page } })
    }
  }, [fetchFilePath, page, projectName])

  const tree = useMemo(() => {
    if (!data || !data.getAllFilePathByProjectName.data) {
      return []
    }
    return data.getAllFilePathByProjectName.data
      .filter((filePath) => filePath.depth === 0)
      .map((filePath) => {
        return makeTree(data.getAllFilePathByProjectName.data, filePath, 0)
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
