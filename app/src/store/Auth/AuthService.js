import { clientSecret, clientId } from 'config/env';
import { loginUrl, userUrl, apiClient, registerUserUrl } from 'routes/api';
import { headers } from 'config/headers';
import { home, login } from 'routes/routes';
import { AUTH_USER } from 'config/consts';
import { LoginAction, LogoutAction } from "store/Auth/AuthAction";

export const LogginService = async function (values, setLoading, addToast, history, dispatch) {

  try {
    const requestOptions = {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        grant_type: 'password',
        client_id: clientId,
        client_secret: clientSecret,
        username: values.email,
        password: values.password,
        scope: ''
      })
    }
    fetch(loginUrl, requestOptions)
      .then(async response => {
        const data = await response.json();

        // check for error response
        if (!response.ok) {
          // get error message from body or default to response status
          const error = (data && data.message) || response.status;
          return Promise.reject(error);
        }

        if (response.status === 200) {

          const authUser = {
            access_token: data.access_token,
            refresh_token: data.refresh_token
          }
          window.localStorage.setItem(AUTH_USER, JSON.stringify(authUser));

          const requestOptions = {
            method: 'GET',
            headers: headers()
          }

          fetch(userUrl, requestOptions)
            .then(async response => {
              const data = await response.json();

              // check for error response
              if (!response.ok) {
                // get error message from body or default to response status
                const error = (data && data.message) || response.status;
                return Promise.reject(error);
              }

              if (response.status === 200) {
                console.log('user', data);
                authUser.email = data.email;
                authUser.name = data.name;
                window.localStorage.setItem(AUTH_USER, JSON.stringify(authUser));
                setLoading(false);
                addToast('Welcome ' + authUser.name, {
                  appearance: 'success',
                  autoDismiss: true,
                });
                LoginAction(dispatch, authUser);
                history.push(home());
              }

            })
            .catch(error => {
              window.localStorage.removeItem(AUTH_USER);
              setLoading(false);
              addToast('User is not activated', {
                appearance: 'error',
                autoDismiss: true,
              });
              console.error('There was an error!', error);
            });
        }
      })
      .catch(error => {
        setLoading(false);
        console.error('There was an error!', error);
        addToast(error, {
          appearance: 'error',
          autoDismiss: true,
        });
      });
  } catch (e) {
    setLoading(false);
    console.log(e);
  }
}

export const RegisterService = (values, setLoading, addToast, history) => {
  try {
    const requestOptions = {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        name: values.name,
        email: values.email,
        password: values.password,
        url: apiClient
      })
    }

    fetch(registerUserUrl, requestOptions)
      .then(async response => {
        const data = await response.json();

        // check for error response
        if (!response.ok) {
          // get error message from body or default to response status
          const error = (data && data.message) || response.status;
          return Promise.reject(error);
        }

        if (response.status === 200) {
          setLoading(false);
          addToast('Registration Complete', {
            appearance: 'success',
            autoDismiss: true,
          });
          history.push(login());
        }

      })
      .catch(error => {
        setLoading(false);
        addToast('Email already exist', {
          appearance: 'error',
          autoDismiss: true,
        });
        console.error('There was an error!', error);
      });
  } catch (e) {
    setLoading(false);
    console.log(e);
  }
}

export const LogoutService = (dispatch) => {
  if (window.localStorage.getItem(AUTH_USER)) {
    window.localStorage.removeItem(AUTH_USER);
    LogoutAction(dispatch);
  }
}