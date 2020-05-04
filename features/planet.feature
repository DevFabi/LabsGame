Feature: Provide a consistent standard JSON API endpoint

  In order to build interchangeable front ends
  As a JSON API developer
  I need to allow Create, Read, Update, and Delete functionality

  Scenario: Adding a new planet
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/planet" with body:
    """
    {
      "name": "King",
      "score": 50
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Get a planet
    When I send a "GET" request to "/planet/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"

   