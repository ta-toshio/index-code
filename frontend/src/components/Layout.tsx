import React, { ReactNode } from 'react'
import Head from 'next/head'
import Navigation from './Navigation'

type Props = {
  children?: ReactNode
  title?: string
}

const Layout = ({ children, title = '' }: Props) => {
  return (
    <>
      <Head>
        <title>{title}</title>
        <meta charSet="utf-8" />
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
      </Head>
      <div className="root">
        <Navigation />
        <main className="main">{children}</main>
      </div>
    </>
  )
}

export default Layout
