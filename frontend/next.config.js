const {
  PHASE_DEVELOPMENT_SERVER,
  PHASE_PRODUCTION_BUILD,
} = require('next/constants')

module.exports = (phase) => {
  // when started in development mode `next dev` or `npm run dev` regardless of the value of STAGING environmental variable
  const isDev = phase === PHASE_DEVELOPMENT_SERVER
  // when `next build` or `npm run build` is used
  const isProd = phase === PHASE_PRODUCTION_BUILD && process.env.STAGING !== '1'
  // when `next build` or `npm run build` is used
  const isStaging =
    phase === PHASE_PRODUCTION_BUILD && process.env.STAGING === '1'

  return {
    env: {
      appHost: process.env.APP_HOST,
      API_SERVER_URI_FROM_BROWSER: (() => {
        if (process.env.APP_HOST === 'localhost') return 'http://localhost:8120'
        if (process.env.APP_HOST.includes('index-code')) {
          if (isDev) return 'http://api.index-code.me:8120'
          if (isStaging) return 'http://api.index-code-stg.com:8120'
          if (isProd) return 'http://api.index-code.com:8120'
        }
        return 'API_SERVER_FROM_BROWSER:not (isDev,isProd && !isStaging,isProd && isStaging)'
      })(),
      API_SERVER_URI_FROM_SERVER: (() => {
        if (process.env.APP_HOST === 'localhost') return 'http://localhost:8120'
        if (process.env.APP_HOST.includes('index-code')) {
          if (isDev) return 'http://web:80'
          if (isStaging) return 'http://web:80'
          if (isProd) return 'http://web:80'
        }
        return 'API_SERVER_FROM_SERVER:not (isDev,isProd && !isStaging,isProd && isStaging)'
      })(),
    },
  }
}
