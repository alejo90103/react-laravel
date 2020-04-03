import React, { useState, useEffect} from 'react';
import { connect, useDispatch } from "react-redux";
import { useToasts } from 'react-toast-notifications'

import App from 'App';

import { ConnectionOnlineAction, ConnectionOfflineAction } from 'store/Connection/ConnectionAction';

const ConnectionCheck = (state) => {
  const dispatch = useDispatch();
  const { addToast } = useToasts();


  useEffect(() => {
    const condition = navigator.onLine ? 'online' : 'offline';
    if (condition === 'online') {
      addToast('Online', {
        appearance: 'success',
        autoDismiss: true,
      });
    } else {
      addToast('Offline', {
        appearance: 'error',
        autoDismiss: true,
      });
    }
    window.addEventListener('online', () => {
      ConnectionOnlineAction(dispatch);
      addToast('Online', {
        appearance: 'success',
        autoDismiss: true,
      });
    });
    window.addEventListener('offline', () => {
      ConnectionOfflineAction(dispatch);
      addToast('Offline', {
        appearance: 'error',
        autoDismiss: true,
      });
    });
  }, []);
  
  return (
    <App />
  );
}

function mapStateToProps(state) {
  return state
};

export default connect(mapStateToProps)(ConnectionCheck);

