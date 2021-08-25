import { useCallback, useState } from 'react'

type Memo = {
  id: number | null | undefined
  key: string
  text: string
}

const useMemoFormState = () => {
  const [memos, setMemos] = useState<Memo[]>([])

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
    console.log(memo)
    console.log(memos)
    console.log(e)

    if (memo.id) {
      // @TODO delete server data
    }
    const _memos = memos.filter((_memo) => _memo.key !== memo.key)
    setMemos([..._memos])
  }, [])

  return {
    memos,
    setMemos,
    onMemoChange,
    onMemoCancel,
  }
}

export default useMemoFormState
