#users
    - id
    - email
    - password
    - role

#profiles
    - id
    - user_id
    - id_number
    - firstname
    - lastname
    - contact

#categories
    - id
    - category_name

#models
    - id
    - model_name

#brands
    - id 
    - brand_name

#items
    - id
    - asset_no
    - category_id
    - model_id
    - brand_id
    - serial_no
    - description
    - date_purchased
    - status (borrowed, available)
    - condition (functional, defective, broken)

#item_requests
    - id
    - item_id
    - user_id
    - employee
    - purpose
    - status (approved, pending, completed, denied)

#borrowed_item
    - id 
    - request_id
    - approved_by
    - remarks
    - date_borrowed
    - date_returned