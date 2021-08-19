import { useEffect } from 'react'
import { useLazyQuery } from '@apollo/client'
import {
  GetFileByFilePathQuery,
  GetFileByFilePathQueryVariables,
} from '../../generated/graphql'
import { GET_FILE_BY_FILE_PATH } from '../../queries/file'

const useCodeByFilePath = ({ projectId, filePath }) => {
  const [fetchFile, { called, loading, data }] = useLazyQuery<
    GetFileByFilePathQuery,
    GetFileByFilePathQueryVariables
  >(GET_FILE_BY_FILE_PATH)

  useEffect(() => {
    if (projectId && filePath) {
      fetchFile({
        variables: {
          projectId: +projectId,
          filePath,
        },
      })
    }
  }, [projectId, filePath])

  return {
    called,
    loading,
    file: data && data.getFileByFilePath,
  }
}

export default useCodeByFilePath
