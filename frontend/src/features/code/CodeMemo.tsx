import React from 'react'
import { CacheMemo } from './useMemoFormState'
import classNames from 'classnames'
import { Loading } from '../../components/spinner/Spinner'

type Props = {
  memo: CacheMemo
  memos: CacheMemo[]
  onMemoChange: (memo: CacheMemo, e) => void
  onMemoSave: (memo: CacheMemo, e) => void
  onMemoCancel: (memo: CacheMemo, memos: CacheMemo[], e) => void
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
          {memo.submitting && (
            <div className="memo__loading">
              <Loading loading={true} />
            </div>
          )}
          <div
            className={classNames({
              memo__content: true,
              'memo__content-loading': memo.submitting,
            })}
          >
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
                {memo.id && 'Delete'}
                {!memo.id && 'Cancel'}
              </button>
              <button
                className={classNames({
                  'button is-primary': true,
                })}
                disabled={memo.submitting}
                onClick={onMemoSave.bind(this, memo)}
              >
                save
              </button>
            </div>
          </div>
        </div>
      </td>
    </tr>
  )
}

export default CodeMemo
