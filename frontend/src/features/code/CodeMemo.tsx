import React from 'react'
import { Memo } from './useMemoFormState'
import classNames from 'classnames'

type Props = {
  memo: Memo
  memos: Memo[]
  onMemoChange: (memo: Memo, e) => void
  onMemoSave: (memo: Memo, e) => void
  onMemoCancel: (memo: Memo, memos: Memo[], e) => void
}

const CodeMemo: React.FC<Props> = ({
  memo,
  memos,
  onMemoChange,
  onMemoSave,
  onMemoCancel,
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
              disabled={memo.submitting}
            >
              cancel
            </button>
            <button
              className={classNames({
                'button is-primary': true,
                'is-loading': memo.submitting,
              })}
              disabled={memo.submitting}
              onClick={onMemoSave.bind(this, memo)}
            >
              save
            </button>
          </div>
        </div>
      </td>
    </tr>
  )
}

export default CodeMemo
