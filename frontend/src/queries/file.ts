import { gql } from '@apollo/client'
import { paginatorInfoFragment } from './app'

export const GET_ALL_FILE_PATH = gql`
  query GetAllFilePath($page: Int!, $projectId: Int!) {
    getAllFilePath(page: $page, projectId: $projectId) {
      data {
        id
        project_id
        name
        file_path
        path
        extension
        parent_id
        is_dir
        depth
      }
      paginatorInfo {
        ...paginatorInfoFragment
      }
    }
  }
  ${paginatorInfoFragment}
`
