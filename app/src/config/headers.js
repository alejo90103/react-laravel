import { AUTH_USER } from 'config/consts';

export const headers = function () {
  const tokenData = JSON.parse(window.localStorage.getItem(AUTH_USER))
  const headers = {
    'Content-Type': 'application/json',
    'Authorization': 'Bearer ' + tokenData.access_token
  }
  return headers
}