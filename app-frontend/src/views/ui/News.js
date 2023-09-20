import React, { useState, useEffect } from 'react';
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
  const [newsData, setNewsData] = useState([]);

  const toggleFilter = () => {
    setIsFilterOpen(!isFilterOpen);
  };

  useEffect(() => {
    // Define a function to fetch news data from your API
    const fetchNewsData = async () => {
      try {
        const response = await fetch('http://localhost:8080/api/news/list');
        if (!response.ok) {
          throw new Error('Failed to fetch data');
        }
        const data = await response.json();
        console.log(data.data);
        setNewsData(data.data); // Update the component state with the fetched data
      } catch (error) {
        console.error(error);
      }
    };

    fetchNewsData(); // Call the fetchNewsData function when the component mounts
  }, []); // The empty dependency array ensures this effect runs only once on component mount

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
        {newsData.map((item, index) => (
            <Col key={index} md="6" lg="4">
              <Card body>
                <CardTitle tag="h5">{item.title}</CardTitle>
                <CardText>{item.content}</CardText>
              </Card>
            </Col>
        ))}
      </Row>
    </div>
  );
};

export default News;
