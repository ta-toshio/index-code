import { gql } from '@apollo/client'
import { paginatorInfoFragment } from './app'

export const memoFragment = gql`
  fragment memoFragment on Memo {
    id
    user_id
    file_id
    code
    codes
    body
    version
    created_at
    updated_at
  }
`

export const MY_MEMO = gql`
  query MyMemo($page: Int!) {
    myMemo(page: $page) {
      data {
        ...memoFragment
      }
      paginatorInfo {
        ...paginatorInfoFragment
      }
    }
  }
  ${memoFragment}
  ${paginatorInfoFragment}
`

export const STORE_MEMO = gql`
  mutation StoreMemo($input: StoreMemoInput!) {
    storeMemo(input: $input) {
      ...memoFragment
    }
  }
  ${memoFragment}
`
