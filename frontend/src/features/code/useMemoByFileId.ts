import { useEffect } from 'react'
import { useLazyQuery } from '@apollo/client'
import {
  MemosByFileIdQuery,
  MemosByFileIdQueryVariables,
} from '../../generated/graphql'
import { MEMOS_BY_FILE_ID } from '../../queries/memo'

type Props = {
  fileId: number
}

const useMemoByFileId = ({ fileId }: Props) => {
  const [fetchMemos, { called, loading, data }] = useLazyQuery<
    MemosByFileIdQuery,
    MemosByFileIdQueryVariables
  >(MEMOS_BY_FILE_ID)

  useEffect(() => {
    if (fileId) {
      fetchMemos({ variables: { fileId } })
    }
  }, [fetchMemos, fileId])

  return {
    called,
    loading,
    memos: data && data.memosByFileId,
  }
}

export default useMemoByFileId
