import { gql } from '@apollo/client';
import * as Apollo from '@apollo/client';
export type Maybe<T> = T | null;
export type Exact<T extends { [key: string]: unknown }> = { [K in keyof T]: T[K] };
export type MakeOptional<T, K extends keyof T> = Omit<T, K> & { [SubKey in K]?: Maybe<T[SubKey]> };
export type MakeMaybe<T, K extends keyof T> = Omit<T, K> & { [SubKey in K]: Maybe<T[SubKey]> };
const defaultOptions =  {}
/** All built-in and custom scalars, mapped to their actual values */
export type Scalars = {
  ID: string;
  String: string;
  Boolean: boolean;
  Int: number;
  Float: number;
  /** A date string with format `Y-m-d`, e.g. `2011-05-23`. */
  Date: any;
  /** A datetime string with format `Y-m-d H:i:s`, e.g. `2018-05-23 13:43:32`. */
  DateTime: any;
};



export type File = {
  __typename?: 'File';
  id: Scalars['ID'];
  project_id: Scalars['Int'];
  name: Scalars['String'];
  file_path: Scalars['String'];
  path?: Maybe<Scalars['String']>;
  body?: Maybe<Scalars['String']>;
  extension?: Maybe<Scalars['String']>;
  description?: Maybe<Scalars['String']>;
  parent_id?: Maybe<Scalars['Int']>;
  is_dir: Scalars['Boolean'];
  depth: Scalars['Int'];
  created_at?: Maybe<Scalars['DateTime']>;
  updated_at?: Maybe<Scalars['DateTime']>;
};

export type FilePath = {
  __typename?: 'FilePath';
  id: Scalars['ID'];
  project_id: Scalars['Int'];
  name: Scalars['String'];
  file_path: Scalars['String'];
  path?: Maybe<Scalars['String']>;
  extension?: Maybe<Scalars['String']>;
  parent_id?: Maybe<Scalars['Int']>;
  is_dir: Scalars['Boolean'];
  depth: Scalars['Int'];
  created_at?: Maybe<Scalars['DateTime']>;
  updated_at?: Maybe<Scalars['DateTime']>;
};

/** A paginated list of FilePath items. */
export type FilePathPaginator = {
  __typename?: 'FilePathPaginator';
  /** Pagination information about the list of items. */
  paginatorInfo: PaginatorInfo;
  /** A list of FilePath items. */
  data: Array<FilePath>;
};

export type LoginAsGoogleInput = {
  provider: Scalars['String'];
  id_token: Scalars['String'];
  email: Scalars['String'];
  name: Scalars['String'];
};

export type Memo = {
  __typename?: 'Memo';
  id: Scalars['ID'];
  user_id: Scalars['Int'];
  file_id: Scalars['Int'];
  code: Scalars['String'];
  codes?: Maybe<Scalars['String']>;
  body?: Maybe<Scalars['String']>;
  version: Scalars['String'];
  created_at?: Maybe<Scalars['DateTime']>;
  updated_at?: Maybe<Scalars['DateTime']>;
};

/** A paginated list of Memo items. */
export type MemoPaginator = {
  __typename?: 'MemoPaginator';
  /** Pagination information about the list of items. */
  paginatorInfo: PaginatorInfo;
  /** A list of Memo items. */
  data: Array<Memo>;
};

export type Mutation = {
  __typename?: 'Mutation';
  loginAsSocial: User;
  storeMemo: Memo;
};


export type MutationLoginAsSocialArgs = {
  input: LoginAsGoogleInput;
};


export type MutationStoreMemoArgs = {
  input: StoreMemoInput;
};

/** Allows ordering a list of records. */
export type OrderByClause = {
  /** The column that is used for ordering. */
  column: Scalars['String'];
  /** The direction that is used for ordering. */
  order: SortOrder;
};

/** Information about pagination using a Relay style cursor connection. */
export type PageInfo = {
  __typename?: 'PageInfo';
  /** When paginating forwards, are there more items? */
  hasNextPage: Scalars['Boolean'];
  /** When paginating backwards, are there more items? */
  hasPreviousPage: Scalars['Boolean'];
  /** The cursor to continue paginating backwards. */
  startCursor?: Maybe<Scalars['String']>;
  /** The cursor to continue paginating forwards. */
  endCursor?: Maybe<Scalars['String']>;
  /** Total number of nodes in the paginated connection. */
  total: Scalars['Int'];
  /** Number of nodes in the current page. */
  count: Scalars['Int'];
  /** Index of the current page. */
  currentPage: Scalars['Int'];
  /** Index of the last available page. */
  lastPage: Scalars['Int'];
};

/** Information about pagination using a fully featured paginator. */
export type PaginatorInfo = {
  __typename?: 'PaginatorInfo';
  /** Number of items in the current page. */
  count: Scalars['Int'];
  /** Index of the current page. */
  currentPage: Scalars['Int'];
  /** Index of the first item in the current page. */
  firstItem?: Maybe<Scalars['Int']>;
  /** Are there more pages after this one? */
  hasMorePages: Scalars['Boolean'];
  /** Index of the last item in the current page. */
  lastItem?: Maybe<Scalars['Int']>;
  /** Index of the last available page. */
  lastPage: Scalars['Int'];
  /** Number of items per page. */
  perPage: Scalars['Int'];
  /** Number of total available items. */
  total: Scalars['Int'];
};

export type Query = {
  __typename?: 'Query';
  user?: Maybe<User>;
  searchText: Array<SearchText>;
  getFileByFilePath: File;
  me?: Maybe<User>;
  users?: Maybe<UserPaginator>;
  getAllFilePath?: Maybe<FilePathPaginator>;
  myMemo?: Maybe<MemoPaginator>;
};


export type QueryUserArgs = {
  id?: Maybe<Scalars['ID']>;
};


export type QuerySearchTextArgs = {
  search: Scalars['String'];
};


export type QueryGetFileByFilePathArgs = {
  project_id: Scalars['Int'];
  file_path: Scalars['String'];
};


export type QueryUsersArgs = {
  first?: Maybe<Scalars['Int']>;
  page?: Maybe<Scalars['Int']>;
};


export type QueryGetAllFilePathArgs = {
  project_id: Scalars['Int'];
  first?: Maybe<Scalars['Int']>;
  page?: Maybe<Scalars['Int']>;
};


export type QueryMyMemoArgs = {
  first?: Maybe<Scalars['Int']>;
  page?: Maybe<Scalars['Int']>;
};

export type SearchText = {
  __typename?: 'SearchText';
  id: Scalars['ID'];
  index_name: Scalars['String'];
  text: Scalars['String'];
  highlight: Scalars['String'];
  score: Scalars['Float'];
};

/** Information about pagination using a simple paginator. */
export type SimplePaginatorInfo = {
  __typename?: 'SimplePaginatorInfo';
  /** Number of items in the current page. */
  count: Scalars['Int'];
  /** Index of the current page. */
  currentPage: Scalars['Int'];
  /** Index of the first item in the current page. */
  firstItem?: Maybe<Scalars['Int']>;
  /** Index of the last item in the current page. */
  lastItem?: Maybe<Scalars['Int']>;
  /** Number of items per page. */
  perPage: Scalars['Int'];
};

/** The available directions for ordering a list of records. */
export enum SortOrder {
  /** Sort records in ascending order. */
  Asc = 'ASC',
  /** Sort records in descending order. */
  Desc = 'DESC'
}

export type StoreMemoInput = {
  id?: Maybe<Scalars['ID']>;
  file_id: Scalars['Int'];
  line: Scalars['Int'];
  body: Scalars['String'];
};

/** Specify if you want to include or exclude trashed results from a query. */
export enum Trashed {
  /** Only return trashed results. */
  Only = 'ONLY',
  /** Return both trashed and non-trashed results. */
  With = 'WITH',
  /** Only return non-trashed results. */
  Without = 'WITHOUT'
}

export type User = {
  __typename?: 'User';
  id: Scalars['ID'];
  name: Scalars['String'];
  email: Scalars['String'];
  email_verified_at?: Maybe<Scalars['DateTime']>;
  created_at?: Maybe<Scalars['DateTime']>;
  updated_at?: Maybe<Scalars['DateTime']>;
};

/** A paginated list of User items. */
export type UserPaginator = {
  __typename?: 'UserPaginator';
  /** Pagination information about the list of items. */
  paginatorInfo: PaginatorInfo;
  /** A list of User items. */
  data: Array<User>;
};

export type PaginatorInfoFragmentFragment = (
  { __typename?: 'PaginatorInfo' }
  & Pick<PaginatorInfo, 'count' | 'currentPage' | 'firstItem' | 'hasMorePages' | 'lastItem' | 'lastPage' | 'perPage' | 'total'>
);

export type FileFragmentFragment = (
  { __typename?: 'File' }
  & Pick<File, 'id' | 'project_id' | 'name' | 'file_path' | 'path' | 'body' | 'extension' | 'description' | 'parent_id' | 'is_dir' | 'depth' | 'created_at' | 'updated_at'>
);

export type GetAllFilePathQueryVariables = Exact<{
  page: Scalars['Int'];
  projectId: Scalars['Int'];
}>;


export type GetAllFilePathQuery = (
  { __typename?: 'Query' }
  & { getAllFilePath?: Maybe<(
    { __typename?: 'FilePathPaginator' }
    & { data: Array<(
      { __typename?: 'FilePath' }
      & Pick<FilePath, 'id' | 'project_id' | 'name' | 'file_path' | 'path' | 'extension' | 'parent_id' | 'is_dir' | 'depth'>
    )>, paginatorInfo: (
      { __typename?: 'PaginatorInfo' }
      & PaginatorInfoFragmentFragment
    ) }
  )> }
);

export type GetFileByFilePathQueryVariables = Exact<{
  projectId: Scalars['Int'];
  filePath: Scalars['String'];
}>;


export type GetFileByFilePathQuery = (
  { __typename?: 'Query' }
  & { getFileByFilePath: (
    { __typename?: 'File' }
    & FileFragmentFragment
  ) }
);

export type MemoFragmentFragment = (
  { __typename?: 'Memo' }
  & Pick<Memo, 'id' | 'user_id' | 'file_id' | 'code' | 'codes' | 'body' | 'version' | 'created_at' | 'updated_at'>
);

export type MyMemoQueryVariables = Exact<{
  page: Scalars['Int'];
}>;


export type MyMemoQuery = (
  { __typename?: 'Query' }
  & { myMemo?: Maybe<(
    { __typename?: 'MemoPaginator' }
    & { data: Array<(
      { __typename?: 'Memo' }
      & MemoFragmentFragment
    )>, paginatorInfo: (
      { __typename?: 'PaginatorInfo' }
      & PaginatorInfoFragmentFragment
    ) }
  )> }
);

export type StoreMemoMutationVariables = Exact<{
  input: StoreMemoInput;
}>;


export type StoreMemoMutation = (
  { __typename?: 'Mutation' }
  & { storeMemo: (
    { __typename?: 'Memo' }
    & MemoFragmentFragment
  ) }
);

export type SearchTextQueryVariables = Exact<{
  search: Scalars['String'];
}>;


export type SearchTextQuery = (
  { __typename?: 'Query' }
  & { searchText: Array<(
    { __typename?: 'SearchText' }
    & Pick<SearchText, 'id' | 'index_name' | 'text' | 'highlight' | 'score'>
  )> }
);

export type UserFragmentFragment = (
  { __typename?: 'User' }
  & Pick<User, 'id' | 'name' | 'email' | 'email_verified_at' | 'created_at' | 'updated_at'>
);

export type UsersQueryVariables = Exact<{
  page: Scalars['Int'];
}>;


export type UsersQuery = (
  { __typename?: 'Query' }
  & { users?: Maybe<(
    { __typename?: 'UserPaginator' }
    & { data: Array<(
      { __typename?: 'User' }
      & UserFragmentFragment
    )>, paginatorInfo: (
      { __typename?: 'PaginatorInfo' }
      & Pick<PaginatorInfo, 'count'>
    ) }
  )> }
);

export type UserQueryVariables = Exact<{
  id: Scalars['ID'];
}>;


export type UserQuery = (
  { __typename?: 'Query' }
  & { user?: Maybe<(
    { __typename?: 'User' }
    & UserFragmentFragment
  )> }
);

export type MeQueryVariables = Exact<{ [key: string]: never; }>;


export type MeQuery = (
  { __typename?: 'Query' }
  & { me?: Maybe<(
    { __typename?: 'User' }
    & UserFragmentFragment
  )> }
);

export type LoginAsSocialMutationVariables = Exact<{
  input: LoginAsGoogleInput;
}>;


export type LoginAsSocialMutation = (
  { __typename?: 'Mutation' }
  & { loginAsSocial: (
    { __typename?: 'User' }
    & UserFragmentFragment
  ) }
);

export const PaginatorInfoFragmentFragmentDoc = gql`
    fragment paginatorInfoFragment on PaginatorInfo {
  count
  currentPage
  firstItem
  hasMorePages
  lastItem
  lastPage
  perPage
  total
}
    `;
export const FileFragmentFragmentDoc = gql`
    fragment fileFragment on File {
  id
  project_id
  name
  file_path
  path
  body
  extension
  description
  parent_id
  is_dir
  depth
  created_at
  updated_at
}
    `;
export const MemoFragmentFragmentDoc = gql`
    fragment memoFragment on Memo {
  id
  user_id
  file_id
  code
  codes
  body
  version
  created_at
  updated_at
}
    `;
export const UserFragmentFragmentDoc = gql`
    fragment userFragment on User {
  id
  name
  email
  email_verified_at
  created_at
  updated_at
}
    `;
export const GetAllFilePathDocument = gql`
    query GetAllFilePath($page: Int!, $projectId: Int!) {
  getAllFilePath(page: $page, project_id: $projectId) {
    data {
      id
      project_id
      name
      file_path
      path
      extension
      parent_id
      is_dir
      depth
    }
    paginatorInfo {
      ...paginatorInfoFragment
    }
  }
}
    ${PaginatorInfoFragmentFragmentDoc}`;

/**
 * __useGetAllFilePathQuery__
 *
 * To run a query within a React component, call `useGetAllFilePathQuery` and pass it any options that fit your needs.
 * When your component renders, `useGetAllFilePathQuery` returns an object from Apollo Client that contains loading, error, and data properties
 * you can use to render your UI.
 *
 * @param baseOptions options that will be passed into the query, supported options are listed on: https://www.apollographql.com/docs/react/api/react-hooks/#options;
 *
 * @example
 * const { data, loading, error } = useGetAllFilePathQuery({
 *   variables: {
 *      page: // value for 'page'
 *      projectId: // value for 'projectId'
 *   },
 * });
 */
export function useGetAllFilePathQuery(baseOptions: Apollo.QueryHookOptions<GetAllFilePathQuery, GetAllFilePathQueryVariables>) {
        const options = {...defaultOptions, ...baseOptions}
        return Apollo.useQuery<GetAllFilePathQuery, GetAllFilePathQueryVariables>(GetAllFilePathDocument, options);
      }
export function useGetAllFilePathLazyQuery(baseOptions?: Apollo.LazyQueryHookOptions<GetAllFilePathQuery, GetAllFilePathQueryVariables>) {
          const options = {...defaultOptions, ...baseOptions}
          return Apollo.useLazyQuery<GetAllFilePathQuery, GetAllFilePathQueryVariables>(GetAllFilePathDocument, options);
        }
export type GetAllFilePathQueryHookResult = ReturnType<typeof useGetAllFilePathQuery>;
export type GetAllFilePathLazyQueryHookResult = ReturnType<typeof useGetAllFilePathLazyQuery>;
export type GetAllFilePathQueryResult = Apollo.QueryResult<GetAllFilePathQuery, GetAllFilePathQueryVariables>;
export const GetFileByFilePathDocument = gql`
    query GetFileByFilePath($projectId: Int!, $filePath: String!) {
  getFileByFilePath(project_id: $projectId, file_path: $filePath) {
    ...fileFragment
  }
}
    ${FileFragmentFragmentDoc}`;

/**
 * __useGetFileByFilePathQuery__
 *
 * To run a query within a React component, call `useGetFileByFilePathQuery` and pass it any options that fit your needs.
 * When your component renders, `useGetFileByFilePathQuery` returns an object from Apollo Client that contains loading, error, and data properties
 * you can use to render your UI.
 *
 * @param baseOptions options that will be passed into the query, supported options are listed on: https://www.apollographql.com/docs/react/api/react-hooks/#options;
 *
 * @example
 * const { data, loading, error } = useGetFileByFilePathQuery({
 *   variables: {
 *      projectId: // value for 'projectId'
 *      filePath: // value for 'filePath'
 *   },
 * });
 */
export function useGetFileByFilePathQuery(baseOptions: Apollo.QueryHookOptions<GetFileByFilePathQuery, GetFileByFilePathQueryVariables>) {
        const options = {...defaultOptions, ...baseOptions}
        return Apollo.useQuery<GetFileByFilePathQuery, GetFileByFilePathQueryVariables>(GetFileByFilePathDocument, options);
      }
export function useGetFileByFilePathLazyQuery(baseOptions?: Apollo.LazyQueryHookOptions<GetFileByFilePathQuery, GetFileByFilePathQueryVariables>) {
          const options = {...defaultOptions, ...baseOptions}
          return Apollo.useLazyQuery<GetFileByFilePathQuery, GetFileByFilePathQueryVariables>(GetFileByFilePathDocument, options);
        }
export type GetFileByFilePathQueryHookResult = ReturnType<typeof useGetFileByFilePathQuery>;
export type GetFileByFilePathLazyQueryHookResult = ReturnType<typeof useGetFileByFilePathLazyQuery>;
export type GetFileByFilePathQueryResult = Apollo.QueryResult<GetFileByFilePathQuery, GetFileByFilePathQueryVariables>;
export const MyMemoDocument = gql`
    query MyMemo($page: Int!) {
  myMemo(page: $page) {
    data {
      ...memoFragment
    }
    paginatorInfo {
      ...paginatorInfoFragment
    }
  }
}
    ${MemoFragmentFragmentDoc}
${PaginatorInfoFragmentFragmentDoc}`;

/**
 * __useMyMemoQuery__
 *
 * To run a query within a React component, call `useMyMemoQuery` and pass it any options that fit your needs.
 * When your component renders, `useMyMemoQuery` returns an object from Apollo Client that contains loading, error, and data properties
 * you can use to render your UI.
 *
 * @param baseOptions options that will be passed into the query, supported options are listed on: https://www.apollographql.com/docs/react/api/react-hooks/#options;
 *
 * @example
 * const { data, loading, error } = useMyMemoQuery({
 *   variables: {
 *      page: // value for 'page'
 *   },
 * });
 */
export function useMyMemoQuery(baseOptions: Apollo.QueryHookOptions<MyMemoQuery, MyMemoQueryVariables>) {
        const options = {...defaultOptions, ...baseOptions}
        return Apollo.useQuery<MyMemoQuery, MyMemoQueryVariables>(MyMemoDocument, options);
      }
export function useMyMemoLazyQuery(baseOptions?: Apollo.LazyQueryHookOptions<MyMemoQuery, MyMemoQueryVariables>) {
          const options = {...defaultOptions, ...baseOptions}
          return Apollo.useLazyQuery<MyMemoQuery, MyMemoQueryVariables>(MyMemoDocument, options);
        }
export type MyMemoQueryHookResult = ReturnType<typeof useMyMemoQuery>;
export type MyMemoLazyQueryHookResult = ReturnType<typeof useMyMemoLazyQuery>;
export type MyMemoQueryResult = Apollo.QueryResult<MyMemoQuery, MyMemoQueryVariables>;
export const StoreMemoDocument = gql`
    mutation StoreMemo($input: StoreMemoInput!) {
  storeMemo(input: $input) {
    ...memoFragment
  }
}
    ${MemoFragmentFragmentDoc}`;
export type StoreMemoMutationFn = Apollo.MutationFunction<StoreMemoMutation, StoreMemoMutationVariables>;

/**
 * __useStoreMemoMutation__
 *
 * To run a mutation, you first call `useStoreMemoMutation` within a React component and pass it any options that fit your needs.
 * When your component renders, `useStoreMemoMutation` returns a tuple that includes:
 * - A mutate function that you can call at any time to execute the mutation
 * - An object with fields that represent the current status of the mutation's execution
 *
 * @param baseOptions options that will be passed into the mutation, supported options are listed on: https://www.apollographql.com/docs/react/api/react-hooks/#options-2;
 *
 * @example
 * const [storeMemoMutation, { data, loading, error }] = useStoreMemoMutation({
 *   variables: {
 *      input: // value for 'input'
 *   },
 * });
 */
export function useStoreMemoMutation(baseOptions?: Apollo.MutationHookOptions<StoreMemoMutation, StoreMemoMutationVariables>) {
        const options = {...defaultOptions, ...baseOptions}
        return Apollo.useMutation<StoreMemoMutation, StoreMemoMutationVariables>(StoreMemoDocument, options);
      }
export type StoreMemoMutationHookResult = ReturnType<typeof useStoreMemoMutation>;
export type StoreMemoMutationResult = Apollo.MutationResult<StoreMemoMutation>;
export type StoreMemoMutationOptions = Apollo.BaseMutationOptions<StoreMemoMutation, StoreMemoMutationVariables>;
export const SearchTextDocument = gql`
    query SearchText($search: String!) {
  searchText(search: $search) {
    id
    index_name
    text
    highlight
    score
  }
}
    `;

/**
 * __useSearchTextQuery__
 *
 * To run a query within a React component, call `useSearchTextQuery` and pass it any options that fit your needs.
 * When your component renders, `useSearchTextQuery` returns an object from Apollo Client that contains loading, error, and data properties
 * you can use to render your UI.
 *
 * @param baseOptions options that will be passed into the query, supported options are listed on: https://www.apollographql.com/docs/react/api/react-hooks/#options;
 *
 * @example
 * const { data, loading, error } = useSearchTextQuery({
 *   variables: {
 *      search: // value for 'search'
 *   },
 * });
 */
export function useSearchTextQuery(baseOptions: Apollo.QueryHookOptions<SearchTextQuery, SearchTextQueryVariables>) {
        const options = {...defaultOptions, ...baseOptions}
        return Apollo.useQuery<SearchTextQuery, SearchTextQueryVariables>(SearchTextDocument, options);
      }
export function useSearchTextLazyQuery(baseOptions?: Apollo.LazyQueryHookOptions<SearchTextQuery, SearchTextQueryVariables>) {
          const options = {...defaultOptions, ...baseOptions}
          return Apollo.useLazyQuery<SearchTextQuery, SearchTextQueryVariables>(SearchTextDocument, options);
        }
export type SearchTextQueryHookResult = ReturnType<typeof useSearchTextQuery>;
export type SearchTextLazyQueryHookResult = ReturnType<typeof useSearchTextLazyQuery>;
export type SearchTextQueryResult = Apollo.QueryResult<SearchTextQuery, SearchTextQueryVariables>;
export const UsersDocument = gql`
    query Users($page: Int!) {
  users(page: $page) {
    data {
      ...userFragment
    }
    paginatorInfo {
      count
    }
  }
}
    ${UserFragmentFragmentDoc}`;

/**
 * __useUsersQuery__
 *
 * To run a query within a React component, call `useUsersQuery` and pass it any options that fit your needs.
 * When your component renders, `useUsersQuery` returns an object from Apollo Client that contains loading, error, and data properties
 * you can use to render your UI.
 *
 * @param baseOptions options that will be passed into the query, supported options are listed on: https://www.apollographql.com/docs/react/api/react-hooks/#options;
 *
 * @example
 * const { data, loading, error } = useUsersQuery({
 *   variables: {
 *      page: // value for 'page'
 *   },
 * });
 */
export function useUsersQuery(baseOptions: Apollo.QueryHookOptions<UsersQuery, UsersQueryVariables>) {
        const options = {...defaultOptions, ...baseOptions}
        return Apollo.useQuery<UsersQuery, UsersQueryVariables>(UsersDocument, options);
      }
export function useUsersLazyQuery(baseOptions?: Apollo.LazyQueryHookOptions<UsersQuery, UsersQueryVariables>) {
          const options = {...defaultOptions, ...baseOptions}
          return Apollo.useLazyQuery<UsersQuery, UsersQueryVariables>(UsersDocument, options);
        }
export type UsersQueryHookResult = ReturnType<typeof useUsersQuery>;
export type UsersLazyQueryHookResult = ReturnType<typeof useUsersLazyQuery>;
export type UsersQueryResult = Apollo.QueryResult<UsersQuery, UsersQueryVariables>;
export const UserDocument = gql`
    query User($id: ID!) {
  user(id: $id) {
    ...userFragment
  }
}
    ${UserFragmentFragmentDoc}`;

/**
 * __useUserQuery__
 *
 * To run a query within a React component, call `useUserQuery` and pass it any options that fit your needs.
 * When your component renders, `useUserQuery` returns an object from Apollo Client that contains loading, error, and data properties
 * you can use to render your UI.
 *
 * @param baseOptions options that will be passed into the query, supported options are listed on: https://www.apollographql.com/docs/react/api/react-hooks/#options;
 *
 * @example
 * const { data, loading, error } = useUserQuery({
 *   variables: {
 *      id: // value for 'id'
 *   },
 * });
 */
export function useUserQuery(baseOptions: Apollo.QueryHookOptions<UserQuery, UserQueryVariables>) {
        const options = {...defaultOptions, ...baseOptions}
        return Apollo.useQuery<UserQuery, UserQueryVariables>(UserDocument, options);
      }
export function useUserLazyQuery(baseOptions?: Apollo.LazyQueryHookOptions<UserQuery, UserQueryVariables>) {
          const options = {...defaultOptions, ...baseOptions}
          return Apollo.useLazyQuery<UserQuery, UserQueryVariables>(UserDocument, options);
        }
export type UserQueryHookResult = ReturnType<typeof useUserQuery>;
export type UserLazyQueryHookResult = ReturnType<typeof useUserLazyQuery>;
export type UserQueryResult = Apollo.QueryResult<UserQuery, UserQueryVariables>;
export const MeDocument = gql`
    query Me {
  me {
    ...userFragment
  }
}
    ${UserFragmentFragmentDoc}`;

/**
 * __useMeQuery__
 *
 * To run a query within a React component, call `useMeQuery` and pass it any options that fit your needs.
 * When your component renders, `useMeQuery` returns an object from Apollo Client that contains loading, error, and data properties
 * you can use to render your UI.
 *
 * @param baseOptions options that will be passed into the query, supported options are listed on: https://www.apollographql.com/docs/react/api/react-hooks/#options;
 *
 * @example
 * const { data, loading, error } = useMeQuery({
 *   variables: {
 *   },
 * });
 */
export function useMeQuery(baseOptions?: Apollo.QueryHookOptions<MeQuery, MeQueryVariables>) {
        const options = {...defaultOptions, ...baseOptions}
        return Apollo.useQuery<MeQuery, MeQueryVariables>(MeDocument, options);
      }
export function useMeLazyQuery(baseOptions?: Apollo.LazyQueryHookOptions<MeQuery, MeQueryVariables>) {
          const options = {...defaultOptions, ...baseOptions}
          return Apollo.useLazyQuery<MeQuery, MeQueryVariables>(MeDocument, options);
        }
export type MeQueryHookResult = ReturnType<typeof useMeQuery>;
export type MeLazyQueryHookResult = ReturnType<typeof useMeLazyQuery>;
export type MeQueryResult = Apollo.QueryResult<MeQuery, MeQueryVariables>;
export const LoginAsSocialDocument = gql`
    mutation LoginAsSocial($input: LoginAsGoogleInput!) {
  loginAsSocial(input: $input) {
    ...userFragment
  }
}
    ${UserFragmentFragmentDoc}`;
export type LoginAsSocialMutationFn = Apollo.MutationFunction<LoginAsSocialMutation, LoginAsSocialMutationVariables>;

/**
 * __useLoginAsSocialMutation__
 *
 * To run a mutation, you first call `useLoginAsSocialMutation` within a React component and pass it any options that fit your needs.
 * When your component renders, `useLoginAsSocialMutation` returns a tuple that includes:
 * - A mutate function that you can call at any time to execute the mutation
 * - An object with fields that represent the current status of the mutation's execution
 *
 * @param baseOptions options that will be passed into the mutation, supported options are listed on: https://www.apollographql.com/docs/react/api/react-hooks/#options-2;
 *
 * @example
 * const [loginAsSocialMutation, { data, loading, error }] = useLoginAsSocialMutation({
 *   variables: {
 *      input: // value for 'input'
 *   },
 * });
 */
export function useLoginAsSocialMutation(baseOptions?: Apollo.MutationHookOptions<LoginAsSocialMutation, LoginAsSocialMutationVariables>) {
        const options = {...defaultOptions, ...baseOptions}
        return Apollo.useMutation<LoginAsSocialMutation, LoginAsSocialMutationVariables>(LoginAsSocialDocument, options);
      }
export type LoginAsSocialMutationHookResult = ReturnType<typeof useLoginAsSocialMutation>;
export type LoginAsSocialMutationResult = Apollo.MutationResult<LoginAsSocialMutation>;
export type LoginAsSocialMutationOptions = Apollo.BaseMutationOptions<LoginAsSocialMutation, LoginAsSocialMutationVariables>;