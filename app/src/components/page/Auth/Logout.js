import React from 'react';
import { Redirect } from 'react-router-dom';
import { useDispatch } from "react-redux";

import { login } from 'routes/routes';
import { LogoutService } from 'store/Auth/AuthService';

const Logout = () => {

  const dispatch = useDispatch();
  LogoutService(dispatch);
  return <Redirect to={login()} />;
}

export default Logout;
