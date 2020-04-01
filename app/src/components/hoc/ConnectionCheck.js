import React, { useState, useEffect } from 'react';
import { connect } from 'react-redux';

const ConnectionCheck = ({Component}) => {
  
  const [isDisconnected, setIsDisconnected] = useState(false);

  const handleConnectionChange = () => {
    const condition = navigator.onLine ? 'online' : 'offline';
    if (condition === 'online') {
      const webPing = setInterval(
        () => {
          fetch('//google.com', { mode: 'no-cors' })
            .then(() => {
              setIsDisconnected(false);
              return clearInterval(webPing)
            })
            .catch(() => {
              return setIsDisconnected(true);
            })
        }, 2000);
      return;
    }
    return setIsDisconnected(true);
  }

  useEffect(() => {
    handleConnectionChange();
    window.addEventListener('online', handleConnectionChange);
    window.addEventListener('offline', handleConnectionChange);
  }, [handleConnectionChange]);

  

  if (isDisconnected){
    return (
      <div className="internet-error">
        <p>Internet connection lost</p>
      </div>
    );
  } else {
    return <Component />;
  }
}

export default ConnectionCheck;
