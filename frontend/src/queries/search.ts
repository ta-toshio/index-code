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

export const SEARCH_TITLE = gql`
  query SearchTitle($search: String!, $type: String!) {
    searchTitle(search: $search, type: $type) {
      id
      search_title
      search_subtitle
      highlight
      __typename
    }
  }
`
