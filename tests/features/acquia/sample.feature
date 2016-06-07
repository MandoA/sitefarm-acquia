Feature: Sample Test
  Makes sure that the testing infrastructure is connecting to the site.

  Background:
    Given I am an anonymous user
    When I am on the homepage

  @acquia
  Scenario: Make sure the word "SiteFarm" is visible
    Then I should see "SiteFarm"

  @acquia
  Scenario: Make sure the word "Acquia" is visible
    Then I should see "Acquia"