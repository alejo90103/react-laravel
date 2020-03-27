const initialState = null;

const AuthReducer = (state = initialState, action) => {
  switch(action.type) {
    case 'LOGIN_SUCCESS':
      return {
        ...state,
        user: action.playload
      }
    case 'LOGOUT':
      return {
        ...state,
        user: undefined
      }
    default:
      return {...state};
  }
}

export default AuthReducer;