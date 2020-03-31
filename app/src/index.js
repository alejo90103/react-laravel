import React from 'react';
import ReactDOM from 'react-dom';
import 'index.css';
import App from 'App';
import * as serviceWorker from 'serviceWorker';
import 'includes/bootstrap';
import { Provider } from 'react-redux';
import { store, persistor } from 'redux/store';
import { PersistGate } from 'redux-persist/lib/integration/react';
import { IntlProvider } from 'react-redux-multilingual';
import { BrowserRouter } from 'react-router-dom';

import Loading from 'components/page/Loading';
import translations from 'lang/translations';

ReactDOM.render(
  <Provider store={store}>
    <IntlProvider translations={translations()} locale='es'>
      <BrowserRouter>
        <PersistGate loading={<Loading />} persistor={persistor}>
          <App />
        </PersistGate>
      </BrowserRouter>
    </IntlProvider>
  </Provider>, document.getElementById('root')
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
