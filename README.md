# SilverStripe Organisations Module

Represents organisations in SilverStripe, and provides reusable functionality. Could be repurposed for businesses, clubs, institutions, etc.

## Features

* Represent organisation model

### Renaming Organisation to something else

```yaml
Organisation:
  singular_name: Business
  plural_name: Businesses
OrganisationAdmin:
  menu_title: Businesses
  url_segment: businesses
OrganisationDirectoryPage:
  singular_name: Business Directory Page
  plural_name: Business Directory Pages
```
