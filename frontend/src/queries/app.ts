import { gql } from '@apollo/client'

export const paginatorInfoFragment = gql`
  fragment paginatorInfoFragment on PaginatorInfo {
    count
    currentPage
    firstItem
    hasMorePages
    lastItem
    lastPage
    perPage
    total
  }
`
