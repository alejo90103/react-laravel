import React from 'react';
import { Redirect } from 'react-router-dom';
import { login } from 'routes/routes';
import { AUTH_USER } from 'config/consts';

const RequireAuth = ({Component}) => {
  
  if (!window.localStorage.getItem(AUTH_USER)) {
    return <Redirect to={login()} />;
  }
  return <Component />;
}

export default RequireAuth;
