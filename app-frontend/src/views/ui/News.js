import React, { useState, useEffect } from 'react';
import {
  Card,
  CardText,
  CardTitle,
  Button,
  Row,
  Col,
  CardBody,
  Form,
  FormGroup,
  Label,
  Input,
} from 'reactstrap';
import Select from 'react-select';
import { API_BASE_URL } from '../../config/config';

const News = () => {
  const [loadingOptions, setLoadingOptions] = useState(true);
  const [isFilterOpen, setIsFilterOpen] = useState(false);
  const [newsData, setNewsData] = useState([]);
  const [sourceOptions, setSourceOptions] = useState([]);
  const [categoryOptions, setCategoryOptions] = useState([]);

  const toggleFilter = () => {
    setIsFilterOpen(!isFilterOpen);
  };

  useEffect(() => {
    const fetchOptions = async (optionType, setOptions) => {
      try {
        const response = await fetch(`http://localhost:8080/api/news/${optionType}`);
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const data = await response.json();
        const options = data[optionType].map((optionType) => ({
          value: optionType,
          label: optionType.charAt(0).toUpperCase() + optionType.slice(1),
        }));
        console.log('options', options);
        setOptions(options);
        setLoadingOptions(false);
      } catch (error) {
        console.error('Error fetching options:', error);
      }
    };

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

    fetchOptions('sources', setSourceOptions);
    fetchOptions('categories', setCategoryOptions);
    fetchNewsData();
  }, []);


  const [keyword, setKeyword] = useState('');
  const [selectedCategories, setSelectedCategories] = useState([]);
  const [selectedSources, setSelectedSources] = useState([]);
  const [date, setDate] = useState('');

  const handleInputChange = (event) => {
    const { name, value } = event.target;
    switch (name) {
      case 'Keyword':
        setKeyword(value);
        break;
      case 'date':
        setDate(value);
        break;
      default:
        break;
    }
  };

  const handleCategoryChange = (selectedOptions) => {
    setSelectedCategories(selectedOptions);
  };

  const handleSourceChange = (selectedOptions) => {
    setSelectedSources(selectedOptions);
  };

  const handleFilterSubmit = async (event) => {
    event.preventDefault();
    try {
      const selectedCategoryValues = selectedCategories.map((category) => category.value);
      const selectedSourceValues = selectedSources.map((source) => source.value);
      const response = await fetch(`${API_BASE_URL}/news/list`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          keyword,
          categories: selectedCategoryValues,
          sources: selectedSourceValues,
          date,
        }),
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
                <Button onClick={toggleFilter} color="light-success">
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
                        <Select
                            id="category"
                            name="category"
                            isMulti
                            options={categoryOptions}
                            value={selectedCategories}
                            onChange={handleCategoryChange}
                        />
                      </FormGroup>
                      <FormGroup>
                        <Label for="source">Source</Label>
                        <Select
                            id="source"
                            name="source"
                            isMulti
                            options={sourceOptions}
                            value={selectedSources}
                            onChange={handleSourceChange}
                        />
                      </FormGroup>
                      <FormGroup>
                        <Label for="date">Date</Label>
                        <Input
                            id="date"
                            name="date"
                            type="date"
                            value={date}
                            onChange={handleInputChange}
                        />
                      </FormGroup>
                      <Button className="mt-2" type="submit">
                        Submit
                      </Button>
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
