import React, { useState } from 'react';
import {
  Card,
  CardText,
  CardTitle,
  Button,
  Row,
  Col, CardBody, Form, FormGroup, Label, Input,
} from "reactstrap";

const News = () => {

  const [isFilterOpen, setIsFilterOpen] = useState(false);
  const toggleFilter = () => {
    setIsFilterOpen(!isFilterOpen);
  };

  return (
    <div>
      <Row>
        <Col>
          <Card>
            <CardTitle tag="h6" className="border-bottom p-3 mb-0">
              <Button onClick={toggleFilter}  color="light-success">
                Filter
              </Button>
            </CardTitle>
            <CardBody>
              {isFilterOpen && (
              <Form>
                <FormGroup>
                  <Label for="Keyword">Keyword</Label>
                  <Input
                      id="Keyword"
                      name="Keyword"
                      placeholder="Filter by keyword"
                      type="string"
                  />
                </FormGroup>
                <FormGroup>
                  <Label for="category">Category</Label>
                  <Input id="category" name="category" type="select">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </Input>
                </FormGroup>
                <FormGroup>
                  <Label for="category">Source</Label>
                  <Input id="source" name="source" type="select">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </Input>
                </FormGroup>
                <Button className="mt-2">Submit</Button>
              </Form>
              )}
            </CardBody>
          </Card>
        </Col>
      </Row>
      <Row>
        <h5 className="mb-3 mt-3">News Feed</h5>
        <Col md="6" lg="4">
          <Card body>
            <CardTitle tag="h5">Special Title Treatment</CardTitle>
            <CardText>
              With supporting text below as a natural lead-in to additional
              content.
            </CardText>
            <div>
              <Button color="light-warning">Go somewhere</Button>
            </div>
          </Card>
        </Col>
        <Col md="6" lg="4">
          <Card body className="text-center">
            <CardTitle tag="h5">Special Title Treatment</CardTitle>
            <CardText>
              With supporting text below as a natural lead-in to additional
              content.
            </CardText>
            <div>
              <Button color="light-danger">Go somewhere</Button>
            </div>
          </Card>
        </Col>
        <Col md="6" lg="4">
          <Card body className="text-end">
            <CardTitle tag="h5">Special Title Treatment</CardTitle>
            <CardText>
              With supporting text below as a natural lead-in to additional
              content.
            </CardText>
            <div>
              <Button color="light-success">Go somewhere</Button>
            </div>
          </Card>
        </Col>
      </Row>
    </div>
  );
};

export default News;
