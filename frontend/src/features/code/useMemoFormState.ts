import { useCallback, useEffect, useState } from 'react'
import { useMutation } from '@apollo/client'
import { toast } from 'react-toastify'
import { DELETE_MEMO, STORE_MEMO } from '../../queries/memo'
import {
  DeleteMemoMutation,
  DeleteMemoMutationVariables,
  Memo,
  StoreMemoMutation,
  StoreMemoMutationVariables,
} from '../../generated/graphql'

export type CacheMemo = {
  id: number | null | undefined
  key: number
  text: string | null | undefined
  submitting: boolean
}

type Props = {
  lineNum: number
  fileId: number
  initialMemos: Memo[]
}

const useMemoFormState = ({ lineNum, fileId, initialMemos }: Props) => {
  const [memos, setMemos] = useState<CacheMemo[]>([])
  const [storeMemo] = useMutation<
    StoreMemoMutation,
    StoreMemoMutationVariables
  >(STORE_MEMO)

  const setSubmitting = (
    submitting: boolean,
    memo: CacheMemo,
    callback: any
  ) => {
    setMemos((prevMemos) => {
      const _memo = prevMemos.find((_memo) => _memo.key === memo.key)
      if (!_memo) return prevMemos
      _memo.submitting = submitting
      callback && callback(_memo)
      return [...prevMemos]
    })
  }

  const [deleteMemo] = useMutation<
    DeleteMemoMutation,
    DeleteMemoMutationVariables
  >(DELETE_MEMO)

  useEffect(() => {
    if (initialMemos && initialMemos.length) {
      const memos = initialMemos.map((memo, i) => ({
        id: +memo.id,
        key: i + 1,
        text: memo.body,
        submitting: false,
      }))
      setMemos(memos)
    } else {
      setMemos([])
    }
  }, [initialMemos])

  const addMemoForm = useCallback(() => {
    setMemos((prevMemos) => {
      prevMemos.push({
        id: null,
        key: prevMemos.length ? prevMemos[prevMemos.length - 1].key + 1 : 0,
        text: '',
        submitting: false,
      })
      return [...prevMemos]
    })
  }, [])

  const onMemoChange = useCallback((memo: CacheMemo, e) => {
    e.preventDefault()
    setMemos((prevMemos) => {
      const _memo = prevMemos.find((_memo) => _memo.key === memo.key)
      if (!_memo) return prevMemos
      _memo.text = e.target.value
      return [...prevMemos]
    })
  }, [])

  const onMemoSave = useCallback(
    (memo: CacheMemo, e) => {
      e.preventDefault()
      setSubmitting(true, memo, null)
      storeMemo({
        variables: {
          input: {
            id: memo.id ? `${memo.id}` : null,
            file_id: fileId,
            line: lineNum,
            body: memo.text || '',
          },
        },
      })
        .then((res) => {
          if (res.data) {
            setSubmitting(false, memo, (targetMemo: CacheMemo) => {
              targetMemo.id = res.data && +res.data.storeMemo.id
            })
            toast('保存しました')
          } else {
            toast.error('保存に失敗しました')
          }
        })
        .catch((e) => {
          console.error(e)
        })
    },
    [storeMemo, fileId, lineNum]
  )

  const onMemoCancel = useCallback(
    (memo: CacheMemo, memos: CacheMemo[], e) => {
      e.preventDefault()

      const removeMemoFromCache = () => {
        const _memos = memos.filter((_memo) => _memo.key !== memo.key)
        setMemos([..._memos])
      }

      const call = async () => {
        if (memo.id) {
          setSubmitting(true, memo, null)

          const res = await deleteMemo({ variables: { id: `${memo.id}` } })
          if (res.data && res.data.deleteMemo) {
            toast('削除しました')
            removeMemoFromCache()
          } else {
            toast.error('削除に失敗しました')
            setSubmitting(false, memo, null)
          }
        } else {
          removeMemoFromCache()
        }
      }

      call()
    },
    [setMemos]
  )

  return {
    memos,
    addMemoForm,
    onMemoChange,
    onMemoSave,
    onMemoCancel,
  }
}

export default useMemoFormState
