import { gql } from '@apollo/client'

export const SEARCH_TEXT = gql`
  query SearchText($search: String!) {
    searchText(search: $search) {
      id
      index_name
      text
      highlight
      score
    }
  }
`
