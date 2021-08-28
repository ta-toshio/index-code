import React from 'react'
import Layout from '../../components/Layout'
// import useSearchText from '../search/useSearchText'
import useSearchTitle, { SEARCH_TITLE_TYPE } from '../search/useSearchTitle'
import { CircleLoadingIcon } from '../../components/icon/SvgIcon'
import Link from 'next/link'
import { getLinkFromSearchPath } from '../../utils/appUtil'

const Top: React.FC = () => {
  const {
    searchTitle,
    called,
    loading,
    data,
    setSearchTitleDebounce,
    radioValue,
    setRadioValue,
  } = useSearchTitle()

  return (
    <Layout title="Home | Next.js + TypeScript Example">
      <section className="hero is-info search-title">
        <div className="hero-body">
          <div className="container">
            <div className="card">
              <div className="card-content">
                <div className="content">
                  <div className="control has-icons-left has-icons-right search-field">
                    <input
                      className="input is-large"
                      type="text"
                      placeholder=""
                      onChange={(e) => setSearchTitleDebounce(e.target.value)}
                    />
                    <span className="icon is-medium is-left">
                      <i className="fa fa-search" />
                    </span>
                    <span className="icon is-medium is-right">
                      <i className="delete is-medium clear-search" />
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div className="control">
              <label className="radio">
                <input
                  type="radio"
                  name="type"
                  value={SEARCH_TITLE_TYPE.name}
                  checked={SEARCH_TITLE_TYPE.name === radioValue}
                  onChange={(e) => {
                    setRadioValue(e.currentTarget.value)
                  }}
                />
                Name
              </label>
              <label className="radio">
                <input
                  type="radio"
                  name="type"
                  value={SEARCH_TITLE_TYPE.code}
                  checked={SEARCH_TITLE_TYPE.code === radioValue}
                  onChange={(e) => {
                    setRadioValue(e.currentTarget.value)
                  }}
                />
                Code
              </label>
            </div>
          </div>
        </div>
      </section>
      <section className="content-center">
        <div className="column is-9">
          <div className="content is-medium pt-3">
            <h3 className="title is-3">Results</h3>
            {called && loading && <CircleLoadingIcon />}
            {searchTitle &&
              data &&
              data.searchTitle &&
              data.searchTitle.map((searchTextData) => (
                <div
                  className="box"
                  key={`search-text-data-${searchTextData.__typename}-${searchTextData.id}`}
                >
                  <Link
                    href={
                      '/projects' +
                      getLinkFromSearchPath(searchTextData.search_subtitle)
                    }
                  >
                    <a>
                      <div className="title is-4">
                        {searchTextData.__typename}
                      </div>
                      <div className="title is-6">
                        {searchTextData.search_subtitle}
                      </div>
                      <pre>
                        <code>
                          {searchTextData.highlight
                            .replaceAll('<em>', '"')
                            .replaceAll('</em>', '"')}
                        </code>
                      </pre>
                    </a>
                  </Link>
                </div>
              ))}
          </div>
        </div>
      </section>
    </Layout>
  )
}

export default Top
