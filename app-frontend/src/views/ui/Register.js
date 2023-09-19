import React, { useState } from 'react';
import {Button, Form, FormGroup, FormText, Input, Label} from "reactstrap";

const Register = () => {
  const [formData, setFormData] = useState({
    username: '',
    password: '',
    confirmPassword: '',
  });
  const [passwordsMatch, setPasswordsMatch] = useState(true);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (formData.password === formData.confirmPassword) {
      setPasswordsMatch(true);
      console.log('Form submitted:', formData);
    } else {
      setPasswordsMatch(false);
    }
    console.log('Form Data:', formData);
  };

  return (
      <div>
        <h2>Register</h2>
        <Form onSubmit={handleSubmit}>
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
