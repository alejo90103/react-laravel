import React, { useState, useEffect } from "react";
import { useHistory } from "react-router-dom";
import { useToasts } from 'react-toast-notifications'
import { useDispatch, connect } from "react-redux";
import { Formik } from "formik";
import {
  Container,
  Jumbotron,
  Row,
  Form,
  Button,
  Spinner
} from 'react-bootstrap';

import { UpdateContactService } from 'store/Contact/ContactService';
import { rowStyled, jumbotronStyled, containerStyled, errorStyled } from 'style/form';

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

const EditContact = (state) => {
  const dispatch = useDispatch();
  const { addToast } = useToasts();
  const history = useHistory();
  const [loading, setLoading] = useState(false);
  const formik = '';
  const [contact, setContact] = useState({
    id: '',
    name: '',
    email: '',
    phone: ''
  });

  useEffect(() => {
    if (history.location.state !== undefined) {
      if (history.location.state.id) {
        const contactFind = state.Contact.contacts.filter(contact => contact.id === history.location.state.id);
        if (contactFind.length > 0) {
          setContact({
            id: contactFind[0].id,
            name: contactFind[0].name,
            email: contactFind[0].email,
            phone: contactFind[0].phone
          });
        } else {
          console.log('Error');
        }
      }
    }
  }, [dispatch, addToast, history, state, formik]);
  

  function handleSubmit(values) {
    setLoading(true);
    UpdateContactService(values, setLoading, addToast, history, dispatch);
  }

  return (
    <div>
      <Row className="justify-content-md-center" style={rowStyled()}>
        <Jumbotron fluid style={jumbotronStyled()} className="col-5">
          <Container style={containerStyled()}>
            <h1 style={{ 'textAlign': 'center' }}>Editar Contacto</h1>
            <br />
            <Formik initialValues={contact} validate={validateForm} onSubmit={handleSubmit} enableReinitialize={true}>
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
                    Editar
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

function mapStateToProps(state) {
  return state
};

export default connect(mapStateToProps)(EditContact);
