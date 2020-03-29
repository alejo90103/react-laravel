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

import { AddContactService } from 'store/Contact/ContactService';
import { rowStyled, jumbotronStyled, containerStyled, errorStyled } from 'style/form';

const initialValues = {
  name: '',
  email: '',
  phone: ''
}

function validateForm(values) {
  const errors = {};
  if (!values.name) {
    errors.name = 'El nombre es requerido';
  }
  if (!values.email) {
    errors.email = 'El correo es requerido';
  }
  if (!values.phone) {
    errors.phone = 'El teléfono es requerido';
  }
  return errors;
}

const AddContact = () => {

  const dispatch = useDispatch();
  const { addToast } = useToasts();
  const history = useHistory();
  const [loading, setLoading] = useState(false);

  function handleSubmit(values) {
    setLoading(true);
    AddContactService(values, setLoading, addToast, history, dispatch);
    values = initialValues;
  }

  return (
    <div>
      <Row className="justify-content-md-center" style={rowStyled()}>
        <Jumbotron fluid style={jumbotronStyled()} className="col-5">
          <Container style={containerStyled()}>
            <h1 style={{ 'textAlign': 'center' }}>Nuevo Contacto</h1>
            <br />
            <Formik initialValues={initialValues} validate={validateForm} onSubmit={handleSubmit}>
              {({ values, errors, touched, handleChange, handleSubmit }) => (
                <Form onSubmit={handleSubmit}>
                  <Form.Group controlId="formBasicName">
                    <Form.Label>Nombre</Form.Label>
                    <Form.Control name="name" type="name" placeholder="Nombre" value={values.name} onChange={handleChange} />
                    {errors.name && touched.name && <p style={errorStyled()}>{errors.name}</p>}
                  </Form.Group>
                  <Form.Group controlId="formBasicEmail">
                    <Form.Label>Correo</Form.Label>
                    <Form.Control name="email" type="email" placeholder="Correo" value={values.email} onChange={handleChange} />
                    {errors.email && touched.email && <p style={errorStyled()}>{errors.email}</p>}
                  </Form.Group>
                  <Form.Group controlId="formBasicPhone">
                    <Form.Label>Teléfono</Form.Label>
                    <Form.Control name="phone" type="phone" placeholder="Teléfono" value={values.phone} onChange={handleChange} />
                    {errors.phone && touched.phone && <p style={errorStyled()}>{errors.phone}</p>}
                  </Form.Group>
                  <Form.Group controlId="formBasicButton" style={{ 'textAlign': 'center' }}>
                    <Button variant="success" type="submit">
                      {loading ? <Spinner as="span" animation="grow" size="sm" role="status" aria-hidden="true" /> : <></>}
                    Guardar
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

export default AddContact;
