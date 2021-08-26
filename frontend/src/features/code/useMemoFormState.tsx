import { useCallback, useState } from 'react'

export type Memo = {
  id: number | null | undefined
  key: number
  text: string
}

const useMemoFormState = () => {
  const [memos, setMemos] = useState<Memo[]>([])

  const addMemoForm = useCallback(() => {
    setMemos((prev) => {
      prev.push({
        id: null,
        key: prev.length ? prev[prev.length - 1].key + 1 : 0,
        text: '',
      })
      return [...prev]
    })
  }, [])

  const onMemoChange = useCallback((memo, e) => {
    e.preventDefault()
    setMemos((_memos) => {
      const __memo = _memos.find((_memo) => _memo.key === memo.key)
      if (__memo) {
        __memo.text = e.target.value
      } else {
        return _memos
      }
      return [..._memos]
    })
  }, [])

  const onMemoCancel = useCallback((memo, memos, e) => {
    e.preventDefault()

    if (memo.id) {
      // @TODO delete server data
    }
    const _memos = memos.filter((_memo) => _memo.key !== memo.key)
    setMemos([..._memos])
  }, [])

  return {
    memos,
    addMemoForm,
    onMemoChange,
    onMemoCancel,
  }
}

export default useMemoFormState
