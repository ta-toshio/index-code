import React from 'react'
import Layout from '../../components/Layout'
import useSearchText from '../search/useSearchText'
import { CircleLoadingIcon } from '../../components/icon/SvgIcon'
import Link from 'next/link'

const Top: React.FC = () => {
  const { searchText, called, loading, data, setSearchTextDebounce } =
    useSearchText()

  return (
    <Layout title="Home | Next.js + TypeScript Example">
      <section className="hero is-info">
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
                      onChange={(e) => setSearchTextDebounce(e.target.value)}
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
          </div>
        </div>
      </section>
      <section className="content-center">
        <div className="column is-9">
          <div className="content is-medium pt-3">
            <h3 className="title is-3">Results</h3>
            {called && loading && <CircleLoadingIcon />}
            {searchText &&
              data &&
              data.searchText &&
              data.searchText.map((searchTextData) => (
                <div
                  className="box"
                  key={`search-text-data-${searchTextData.index_name}-${searchTextData.id}`}
                >
                  <Link href={`/projects/1/${searchTextData.id}/a/b.php`}>
                    <a>
                      <span className="title is-3">
                        {searchTextData.index_name}
                      </span>
                      <pre>
                        <code
                          className="language-javascript"
                          dangerouslySetInnerHTML={{
                            __html: searchTextData.highlight,
                          }}
                        />
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
