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
    const fetchNewsData = async () => {
      try {
        const accessToken = localStorage.getItem('accessToken');
        console.log('token', accessToken);
        const response =await fetch('http://localhost:8080/api/news/list', {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${accessToken}`,
          },
        });
        if (!response.ok) {
          throw new Error('Failed to fetch data');
        }
        const data = await response.json();
        console.log(data.data);
        setNewsData(data.data);
      } catch (error) {
        console.error(error);
      }
    };

    fetchNewsData(); // Call the fetchNewsData function when the component mounts
  }, []); // The empty dependency array ensures this effect runs only once on component mount

  const [keyword, setKeyword] = useState('');
  const [category, setCategory] = useState('');
  const [source, setSource] = useState('');
  const [date, setDate] = useState('');
  const handleInputChange = (event) => {
    const { name, value } = event.target;
    switch (name) {
      case 'Keyword':
        setKeyword(value);
        break;
      case 'category':
        setCategory(value);
        break;
      case 'source':
        setSource(value);
        break;
      case 'date':
        setDate(value);
        break;
      default:
        break;
    }
  };

  const handleFilterSubmit = async (event) => {
    event.preventDefault();
    try {
      console.log('filter data', { keyword, category, source, date });
      // Send a request to the backend with filtering data
      const response = await fetch('http://localhost:8080/api/news/list', {
        method: 'POST', // Use the appropriate HTTP method (POST or GET) for your API
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ keyword, category, source, date }),
      });

      if (!response.ok) {
        throw new Error('Failed to fetch data');
      }

      const data = await response.json();

      setNewsData(data.data);

    } catch (error) {
      console.error(error);
    }
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
              <Form onSubmit={handleFilterSubmit}>
                <FormGroup>
                  <Label for="Keyword">Keyword</Label>
                  <Input
                      id="Keyword"
                      name="Keyword"
                      type="string"
                      value={keyword}
                      onChange={handleInputChange}
                  />
                </FormGroup>
                <FormGroup>
                  <Label for="category">Category</Label>
                  <Input id="category"
                         name="category"
                         type="string"
                         value={category}
                         onChange={handleInputChange}
                  >
                  </Input>
                </FormGroup>
                <FormGroup>
                  <Label for="source">Source</Label>
                  <Input id="source"
                         name="source"
                         type="string"
                         value={source}
                         onChange={handleInputChange}
                  >
                  </Input>
                </FormGroup>
                <FormGroup>
                  <Label for="date">Date</Label>
                  <Input id="date"
                         name="date"
                         type="string"
                         value={date}
                         onChange={handleInputChange}
                  >
                  </Input>
                </FormGroup>
                <Button className="mt-2" type="submit">Submit</Button>
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
