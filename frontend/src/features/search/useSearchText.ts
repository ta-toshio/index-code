import { useLazyQuery } from '@apollo/client'
import { SEARCH_TEXT } from '../../queries/search'
import { useEffect, useState } from 'react'
import {
  SearchTextQuery,
  SearchTextQueryVariables,
} from '../../generated/graphql'
import useDebouncedCallback from '../../utils/useDebouncedCallback'

const useSearchText = () => {
  const [loadSearchName, { called, loading, data }] = useLazyQuery<
    SearchTextQuery,
    SearchTextQueryVariables
  >(SEARCH_TEXT)

  const [searchText, setSearchText] = useState<string>('')
  const setSearchTextDebounce = useDebouncedCallback(
    // function
    (value) => {
      setSearchText(value)
    },
    // delay in ms
    1000
  )

  useEffect(() => {
    if (!searchText) {
      return
    }
    loadSearchName({
      variables: {
        search: searchText,
      },
    })
  }, [searchText])

  return {
    called,
    loading,
    data,
    searchText,
    setSearchTextDebounce,
  }
}

export default useSearchText
