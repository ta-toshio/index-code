export const getLanguage = (extension: string) => {
  if (!extension) {
    return ''
  }
  switch (extension) {
    case 'php':
      return 'php'
    case 'rb':
      return 'ruby'
    case 'ts':
      return 'typescript'
    case 'json':
      return 'json'
    default:
      return ''
  }
}
