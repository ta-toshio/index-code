import React, { useState } from 'react'
import CodeLine from './CodeLine'
import { File } from '../../generated/graphql'
import useMemoFormState from './useMemoFormState'

type Props = {
  line: string
  file: File
  index: number
}

const CodeLineWrapper: React.FC<Props> = (props) => {
  const { memos, setMemos, onMemoChange, onMemoCancel } = useMemoFormState()
  return (
    <>
      <tr>
        <CodeLine {...props} setNodes={setMemos} />
      </tr>
      {(memos &&
        memos.map((memo, i) => (
          <tr key={`memo-${i}`}>
            <td colSpan={2}>
              <div className="memo">
                <div className="memo__form">
                  <div className="field">
                    <div className="control">
                      <textarea
                        className="textarea is-large"
                        value={memo.text}
                        onChange={onMemoChange.bind(this, memo)}
                      />
                    </div>
                  </div>
                </div>
                <div className="memo__actions">
                  <button
                    className="button"
                    onClick={onMemoCancel.bind(this, memo, memos)}
                  >
                    cancel
                  </button>
                  <button className="button is-primary">save</button>
                </div>
              </div>
            </td>
          </tr>
        ))) ||
        undefined}
    </>
  )
}

export default CodeLineWrapper
