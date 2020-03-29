import React, { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import { ToastProvider } from 'react-toast-notifications'
import MainMenu from 'components/UI/MainMenu';
import { login, home, logout, register, showContact, addContact, editContact } from 'routes/routes';
import RequireAuth from 'components/hoc/RequireAuth';
import Loading from 'components/page/Loading';

const Home = lazy(() => import('components/page/Home'));

// AUTH
const Login = lazy(() => import('components/page/Auth/Login'));
const Register = lazy(() => import('components/page/Auth/Register'));
const Logout = lazy(() => import('components/page/Auth/Logout'));

// CONTACT
const ShowContact = lazy(() => import('components/page/Contact/ShowContact'));
const AddContact = lazy(() => import('components/page/Contact/AddContact'));
const EditContact = lazy(() => import('components/page/Contact/EditContact'));

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
                  render={props => <RequireAuth {...props} Component={Home} />}
                />
                <Route path={login()}
                  component={ Login }
                />
                <Route path={register()}
                  component={ Register }
                />
                <Route path={logout()}
                  render={props => <RequireAuth {...props} Component={Logout} />}
                />
                <Route path={showContact()}
                  render={props => <RequireAuth {...props} Component={ShowContact} />}
                />
                <Route path={addContact()}
                  render={props => <RequireAuth {...props} Component={AddContact} />}
                />
                <Route path={editContact()}
                  render={props => <RequireAuth {...props} Component={EditContact} />}
                />
              </Switch>
            </div>
          </Suspense>
        </Router>
      </ToastProvider>
    </div>
  );
}

export default App;
