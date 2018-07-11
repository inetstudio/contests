# Elasticsearch

````
PUT app_index
PUT app_index/_mapping/contests
{
  "properties": {
    "id": {
        "type": "integer"
    },
    "title": {
        "type": "string"
    },
    "description": {
        "type": "text"
    },  
    "content": {
        "type": "text"
    },	
    "categories": {
        "type": "nested"
    },
    "tags": {
        "type": "nested"
    }
  }
}
````
