import React, { useState } from "react";
import { useHistory } from "react-router-dom";
import { useToasts } from 'react-toast-notifications'
import { Formik } from "formik";
import {
  Container,
  Jumbotron,
  Row,
  Form,
  Button,
  Spinner
} from 'react-bootstrap';

import { RegisterService } from 'store/Auth/AuthService';
import { rowStyled, jumbotronStyled, containerStyled, errorStyled } from 'style/form';


const initialValues = {
  name: '',
  email: '',
  password: '',
  confirm_password: ''
}

function validateForm(values) {
  const errors = {};
  if (!values.name) {
    errors.name = 'El nombre es requerido';
  }
  if (!values.email) {
    errors.email = 'El correo es requerido';
  }
  if (!values.password) {
    errors.password = 'La contraseña es requerida';
  }
  if (!values.confirm_password) {
    errors.confirm_password = 'La confirmación de la contraseña es requerida';
  }
  return errors;
}

const Register = () => {
  const { addToast } = useToasts();
  const history = useHistory();
  const [loading, setLoading] = useState(false);

  function handleSubmit(values) {
    setLoading(true);
    if (values.password === values.confirm_password) {
      RegisterService(values, setLoading, addToast, history);
    } else {
      addToast('Las contraseñas no coinciden', {
        appearance: 'error',
        autoDismiss: true,
      });
      setLoading(false);
    }
  }

  return (
    <div>
      <Row className="justify-content-md-center" style={rowStyled()}>
        <Jumbotron fluid style={jumbotronStyled()} className="col-5">
          <Container style={containerStyled()}>
            <h1 style={{ 'textAlign': 'center' }}>Bienvenido</h1>
            <br />
            <Formik initialValues={initialValues} validate={validateForm} onSubmit={handleSubmit}>
              {({ values, errors, touched, handleChange, handleSubmit }) => (
                <Form onSubmit={handleSubmit}>
                  <Form.Group controlId="formBasicEmail">
                    <Form.Label>Nombre</Form.Label>
                    <Form.Control name="name" type="text" placeholder="Nombre" value={values.name} onChange={handleChange} />
                    {errors.name && touched.name && <p style={errorStyled()}>{errors.name}</p>}
                  </Form.Group>
                  <Form.Group controlId="formBasicEmail">
                    <Form.Label>Correo</Form.Label>
                    <Form.Control name="email" type="email" placeholder="Correo" value={values.email} onChange={handleChange} />
                    {errors.email && touched.email && <p style={errorStyled()}>{errors.email}</p>}
                  </Form.Group>
                  <Form.Group controlId="formBasicPassword">
                    <Form.Label>Contraseña</Form.Label>
                    <Form.Control name="password" type="password" placeholder="Contraseña" value={values.password} onChange={handleChange} />
                    {errors.password && touched.password && <p style={errorStyled()}>{errors.password}</p>}
                  </Form.Group>
                  <Form.Group controlId="formBasicPasswordConfirm">
                    <Form.Label>Confirmar Contraseña</Form.Label>
                    <Form.Control name="confirm_password" type="password" placeholder="Contraseña" value={values.confirm_password} onChange={handleChange} />
                    {errors.confirm_password && touched.confirm_password && <p style={errorStyled()}>{errors.confirm_password}</p>}
                  </Form.Group>
                  <Form.Group controlId="formBasicButton" style={{ 'textAlign': 'center' }}>
                    <Button variant="primary" type="submit">
                      {loading ? <Spinner as="span" animation="grow" size="sm" role="status" aria-hidden="true" /> : <></>}
                    Registarse
                  </Button>
                  </Form.Group>
                </Form>
              )}
            </Formik>
          </Container>
        </Jumbotron>
      </Row>
    </div>
  );
}

export default Register;
