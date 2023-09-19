import React, { useState } from 'react';
import {Button, Form, FormGroup, FormText, Input, Label} from "reactstrap";

const Setting = () => {
  const [formData, setFormData] = useState({
    username: '',
    password: '',
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Here, you can add code to validate and submit the form data
    // For a simple example, we'll just log the data to the console
    console.log('Form Data:', formData);
  };

  return (
      <div>
        <h2>Set preferences</h2>
        <Form onSubmit={handleSubmit}>
          <FormGroup>
            <Label for="sources">Sources</Label>
            <Input
                id="sources"
                name="sources"
                placeholder="Please select sources"
                type="string"
                onChange={handleChange}
                value={formData.email}
                required
            />
          </FormGroup>
          <FormGroup>
            <Label for="categories">Categories</Label>
            <Input
                id="categories"
                name="categories"
                placeholder="Please select categories"
                type="string"
                onChange={handleChange}
                value={formData.password}
                required
            />
          </FormGroup>
          <FormGroup>
            <Label for="authors">Authors</Label>
            <Input
                id="authors"
                name="authors"
                placeholder="Please select authors"
                type="string"
                onChange={handleChange}
                value={formData.password}
                required
            />
          </FormGroup>
          <Button className="mt-2">Submit</Button>
        </Form>
      </div>
  );
};

export default Setting;
