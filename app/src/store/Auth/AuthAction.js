
export const LoginAction = function (dispatch, authUser) {
  dispatch({
    type: 'LOGIN_SUCCESS',
    playload: authUser
  });
}

export const LogoutAction = function (dispatch) {
  dispatch({
    type: 'LOGOUT'
  });
}