import { useLazyQuery } from '@apollo/client'
import { SEARCH_TITLE } from '../../queries/search'
import { useEffect, useState } from 'react'
import {
  SearchTitleQuery,
  SearchTitleQueryVariables,
} from '../../generated/graphql'
import useDebouncedCallback from '../../utils/useDebouncedCallback'

export const SEARCH_TITLE_TYPE = {
  name: 'NAME',
  code: 'CODE',
}

const useSearchText = () => {
  const [radioValue, setRadioValue] = useState<string>(SEARCH_TITLE_TYPE.name)
  const [loadSearchName, { called, loading, data }] = useLazyQuery<
    SearchTitleQuery,
    SearchTitleQueryVariables
  >(SEARCH_TITLE)

  const [searchTitle, setSearchTitle] = useState<string>('')
  const setSearchTitleDebounce = useDebouncedCallback(
    // function
    (value) => {
      setSearchTitle(value)
    },
    // delay in ms
    1000
  )

  useEffect(() => {
    if (!searchTitle) {
      return
    }
    loadSearchName({
      variables: {
        search: searchTitle,
        type: radioValue,
      },
    })
  }, [searchTitle, radioValue])

  return {
    called,
    loading,
    data,
    searchTitle,
    setSearchTitleDebounce,
    radioValue,
    setRadioValue,
  }
}

export default useSearchText
