import React, { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import { ToastProvider } from 'react-toast-notifications'
import MainMenu from 'components/UI/MainMenu';
import { login, home, logout, register } from 'routes/routes';
import RequireAuth from 'components/hoc/RequireAuth';
import Loading from 'components/page/Loading';

const Login = lazy(() => import('components/page/Login'));
const Logout = lazy(() => import('components/page/Logout'));
const Home = lazy(() => import('components/page/Home'));
const Register = lazy(() => import('components/page/Register'));

function App() {
  return (
    <div>
      <ToastProvider>
        <Router>
          <Suspense fallback={<Loading />}>
            <MainMenu />
            <div className="container">
              <Switch>
                <Route
                  path={home()}
                  component={props => <RequireAuth {...props} Component={Home} />}
                />
                <Route path={login()}>
                  <Login />
                </Route>
                <Route path={register()}>
                  <Register />
                </Route>
                <Route path={logout()}>
                  <Logout />
                </Route>
              </Switch>
            </div>
          </Suspense>
        </Router>
      </ToastProvider>
    </div>
  );
}

export default App;
