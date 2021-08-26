import React from 'react'
import CodeLine from './CodeLine'
import { File } from '../../generated/graphql'
import useMemoFormState from './useMemoFormState'
import CodeMemo from './CodeMemo'

type Props = {
  line: string
  file: File
  index: number
}

const CodeLineWrapper: React.FC<Props> = (props) => {
  const { memos, addMemoForm, onMemoChange, onMemoSave, onMemoCancel } =
    useMemoFormState({ lineNum: props.index, fileId: +props.file.id })
  return (
    <>
      <CodeLine {...props} addMemoForm={addMemoForm} />
      {(memos &&
        memos.map((memo, i) => (
          <CodeMemo
            key={`memo-${i}`}
            memo={memo}
            memos={memos}
            onMemoSave={onMemoSave}
            onMemoChange={onMemoChange}
            onMemoCancel={onMemoCancel}
          />
        ))) ||
        undefined}
    </>
  )
}

export default CodeLineWrapper
