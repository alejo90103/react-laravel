export const ConnectionOnlineAction = function (dispatch) {
  dispatch({
    type: 'ONLINE'
  });
}

export const ConnectionOfflineAction = function (dispatch) {
  dispatch({
    type: 'OFFLINE'
  });
}