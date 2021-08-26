import React from 'react'
import { Memo } from './useMemoFormState'

type Props = {
  memo: Memo
  memos: Memo[]
  onMemoChange: (memo, e) => void
  onMemoCancel: (memo, memos, e) => void
}

const CodeMemo: React.FC<Props> = ({
  memo,
  memos,
  onMemoCancel,
  onMemoChange,
}) => {
  return (
    <tr>
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
  )
}

export default CodeMemo
