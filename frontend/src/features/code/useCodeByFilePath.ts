import { useEffect } from 'react'
import { useLazyQuery } from '@apollo/client'
import {
  GetFileByFilePathAndProjectNameQuery,
  GetFileByFilePathAndProjectNameQueryVariables,
} from '../../generated/graphql'
import { GET_FILE_BY_FILE_PATH_AND_PROJECT_NAME } from '../../queries/file'
import useDebouncedCallback from '../../utils/useDebouncedCallback'

type Props = {
  projectName: string | undefined
  filePath: string | undefined
}

const useCodeByFilePath = ({ projectName, filePath }: Props) => {
  const [fetchFile, { called, loading, data }] = useLazyQuery<
    GetFileByFilePathAndProjectNameQuery,
    GetFileByFilePathAndProjectNameQueryVariables
  >(GET_FILE_BY_FILE_PATH_AND_PROJECT_NAME)

  const debounced = useDebouncedCallback(
    // function
    (projectName, filePath) => {
      fetchFile({
        variables: {
          projectName: projectName,
          filePath,
        },
      })
    },
    // delay in ms
    2000
  )

  useEffect(() => {
    if (projectName && filePath) {
      debounced(projectName, filePath)
    }
  }, [projectName, filePath])

  return {
    called,
    loading,
    file: data && data.getFileByFilePathAndProjectName,
  }
}

export default useCodeByFilePath
