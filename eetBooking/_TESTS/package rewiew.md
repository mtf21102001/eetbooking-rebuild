Package Schema Analysis & Refactoring Plan
1. Current State ("The Sheet")
The current packages table contains 77 columns. This is bloated and difficult to maintain.

Key Issues:
Redundant Arabic Columns: titleAr, descriptionAr, shortDescriptionAr, bestTimeToVisitAr, cancellationPolicyAr, termsAndConditionsAr, customTextAr, etc. (Should be in a translations table).
Duplicate JSON Fields: inclusions vs includedFeatures.
Hardcoded Logic: adultCount, childrenCount defaults (business logic mixed with data).
Complex JSON Blobs: itinerary, whatToPack, travelRoute are stored as JSON without a strict schema, making queries difficult.
Mixed Concerns: Pricing logic (markup, discountType, pricingMode) is mixed with content.
2. Proposed "Clean" Schema
We will move to a relational structure.

New packages Table (Core Data)
Column	Type	Notes
id
Serial	Primary Key
slug	Text	Unique URL friendly ID
category_id	Int	Reference to category
destination_id	Int	Main destination
price	Int	Base price
currency	Text	Default 'EGP'
duration_days	Int	Number of days
featured	Boolean	For homepage display
created_at	Timestamp	
New package_translations Table (Multi-language)
Column	Type	Notes
id
Serial	PK
package_id	Int	FK
locale	Text	'en', 'ar', etc.
title	Text	
description	Text	HTML/Markdown supported
itinerary	JSONB	Structure day-by-day content
inclusions	JSONB	List of strings
New package_media Table
Column	Type	Notes
id
Serial	PK
package_id	Int	FK
url	Text	S3/Local path
type	Text	'image', 'video'
is_hero	Boolean	Cover image
3. Data Needed for migration
To refactor successfully, we need to extract:

Core Identifiers: slug, price, duration.
Content: English & Arabic titles/descriptions.
Images: All usages of imageUrl and galleryUrls.
Itineraries: Convert current text or 
json
 itineraries into a structured format.
Request for User
Please confirm if you want to:

 Migrate existing data (complex) OR
 Start fresh with the new schema (recommended for clean slate)