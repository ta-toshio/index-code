import { useCallback, useEffect, useState } from 'react'
import { useMutation } from '@apollo/client'
import { toast } from 'react-toastify'
import { STORE_MEMO } from '../../queries/memo'
import {
  Memo,
  StoreMemoMutation,
  StoreMemoMutationVariables,
} from '../../generated/graphql'

export type CacheMemo = {
  id: number | null | undefined
  key: number
  text: string
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

  useEffect(() => {
    if (initialMemos && initialMemos.length) {
      const memos = initialMemos.map((memo, i) => ({
        id: +memo.id,
        key: i + 1,
        text: memo.body,
        submitting: false,
      }))
      setMemos(memos)
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
      setMemos((prevMemos) => {
        const _memo = prevMemos.find((_memo) => _memo.key === memo.key)
        if (!_memo) return prevMemos
        _memo.submitting = true
        return [...prevMemos]
      })
      storeMemo({
        variables: {
          input: {
            id: memo.id ? `${memo.id}` : null,
            file_id: fileId,
            line: lineNum,
            body: memo.text || null,
          },
        },
      })
        .then((res) => {
          if (res.data) {
            setMemos((prevMemos) => {
              const _memo = prevMemos.find((_memo) => _memo.key === memo.key)
              if (!_memo) return prevMemos
              _memo.id = +res.data.storeMemo.id
              _memo.submitting = false
              return [...prevMemos]
            })
            toast('保存しました')
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

      if (memo.id) {
        // @TODO delete server data
      }
      const _memos = memos.filter((_memo) => _memo.key !== memo.key)
      setMemos([..._memos])
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
