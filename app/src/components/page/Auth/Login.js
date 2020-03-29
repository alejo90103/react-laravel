import React, { useState } from "react";
import { useHistory } from "react-router-dom";
import { useToasts } from 'react-toast-notifications'
import { useDispatch } from "react-redux";
import { Formik } from "formik";
import {
  Container,
  Jumbotron,
  Row,
  Form,
  Button,
  Spinner
} from 'react-bootstrap';

import { LogginService } from 'store/Auth/AuthService';
import { rowStyled, jumbotronStyled, containerStyled, errorStyled } from 'style/form';

const initialValues = {
  email: '',
  password: ''
}

function validateForm(values) {
  const errors = {};
  if (!values.email) {
    errors.email = 'El correo es requerido';
  }
  if (!values.password) {
    errors.password = 'La contraseña es requerida';
  }
  return errors;
}

const Login = function () {
  
  const dispatch = useDispatch();
  const { addToast } = useToasts();
  const history = useHistory();
  const [loading, setLoading] = useState(false);

  function handleSubmit(values) {
    setLoading(true);
    LogginService(values, setLoading, addToast, history, dispatch);
  }

  return (
    <Row className="justify-content-md-center" style={rowStyled()}>
      <Jumbotron fluid style={jumbotronStyled()} className="col-5">
        <Container style={containerStyled()}>
          <h1 style={{ 'textAlign': 'center' }}>Bienvenido</h1>
          <br />
          <Formik initialValues={initialValues} validate={validateForm} onSubmit={handleSubmit}>
            {({ values, errors, touched, handleChange, handleSubmit }) => (
              <Form onSubmit={handleSubmit}>
                <Form.Group controlId="formBasicEmail">
                  <Form.Label>Usuario</Form.Label>
                  <Form.Control name="email" type="email" placeholder="Correo" value={values.email} onChange={handleChange} />
                  {errors.email && touched.email && <p style={errorStyled()}>{errors.email}</p>}
                </Form.Group>
                <Form.Group controlId="formBasicPassword">
                  <Form.Label>Contraseña</Form.Label>
                  <Form.Control name="password" type="password" placeholder="Contraseña" value={values.password} onChange={handleChange} />
                  {errors.password && touched.password && <p style={errorStyled()}>{errors.password}</p>}
                </Form.Group>
                <Form.Group controlId="formBasicButton" style={{ 'textAlign': 'center' }}>
                  <Button variant="primary" type="submit">
                    {loading ? <Spinner as="span" animation="grow" size="sm" role="status" aria-hidden="true" /> : <></>}
                    Entrar
                  </Button>
                </Form.Group>
              </Form>
            )}
          </Formik>
        </Container>
      </Jumbotron>
    </Row>
  )
}

export default Login;