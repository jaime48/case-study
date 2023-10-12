import React, { useState } from 'react';
import {Button, Form, FormGroup, Input, Label} from "reactstrap";
import { useNavigate } from 'react-router-dom';
import { API_BASE_URL } from '../../config/config';

const Register = () => {
  const navigate  = useNavigate();

  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    confirmPassword: '',
  });
  const [passwordsMatch, setPasswordsMatch] = useState(true);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (formData.password === formData.confirmPassword) {
      setPasswordsMatch(true);
    } else {
      setPasswordsMatch(false);
    }
    const response = await fetch(`${API_BASE_URL}/register`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(formData),
    });
    console.log(response);
    if (response.status === 200) {
      navigate('/login');
    } else {
      console.error('Registration failed');
    }
  };

  return (
      <div>
        <h2>Register</h2>
        <Form onSubmit={handleSubmit}>
          <FormGroup>
            <Label for="name">Name</Label>
            <Input
                id="name"
                name="name"
                type="string"
                onChange={handleChange}
                value={formData.name}
                required
            />
          </FormGroup>
          <FormGroup>
            <Label for="email">Email</Label>
            <Input
                id="email"
                name="email"
                placeholder="Please enter Email"
                type="string"
                onChange={handleChange}
                value={formData.email}
                required
            />
          </FormGroup>
          <FormGroup>
            <Label for="password">Password</Label>
            <Input
                id="password"
                name="password"
                placeholder="Please enter password"
                type="password"
                onChange={handleChange}
                value={formData.password}
                required
            />
          </FormGroup>
          <FormGroup>
            <Label for="confirmPassword">Password</Label>
            <Input
                id="confirmPassword"
                name="confirmPassword"
                placeholder="Please confirm password"
                type="password"
                onChange={handleChange}
                value={formData.confirmPassword}
                required
            />
          </FormGroup>
          {passwordsMatch ? null : (
              <p className="text-danger">Passwords do not match</p>
          )}
          <Button className="mt-2">Submit</Button>
        </Form>
      </div>
  );
};

export default Register;
