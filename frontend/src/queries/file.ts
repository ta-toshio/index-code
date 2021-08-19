import { gql } from '@apollo/client'
import { paginatorInfoFragment } from './app'

export const fileFragment = gql`
  fragment fileFragment on File {
    id
    project_id
    name
    file_path
    path
    body
    extension
    description
    parent_id
    is_dir
    depth
    created_at
    updated_at
  }
`

export const GET_ALL_FILE_PATH = gql`
  query GetAllFilePath($page: Int!, $projectId: Int!) {
    getAllFilePath(page: $page, project_id: $projectId) {
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

export const GET_FILE_BY_FILE_PATH = gql`
  query GetFileByFilePath($projectId: Int!, $filePath: String!) {
    getFileByFilePath(project_id: $projectId, file_path: $filePath) {
      ...fileFragment
    }
  }
  ${fileFragment}
`
