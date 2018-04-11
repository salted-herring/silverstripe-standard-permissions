<?php
/**
 * @file StandardPermissions.php
 * Adds CMS defined permissions for publishing
 */

/**
 * An extension which controls the 'can*' functions in an object.
 */
class StandardPermissions extends DataExtension implements PermissionProvider
{

    /**
     * Can the user publish this?
     */
    public function canPublish($member = false)
    {
        return Permission::check(get_class($this->owner) . '_publish');
    }

    /**
     * Can the user unpublish this?
     */
    public function canUnpublish($member = false)
    {
        return Permission::check(get_class($this->owner) . '_unpublish');
    }

    /**
     * Can the user archive this?
     */
    public function canArchive($member = false)
    {
        return Permission::check(get_class($this->owner) . '_archive');
    }

    public function canView($member = false)
    {
        return Permission::check(get_class($this->owner) . '_view');
    }
    public function canEdit($member = false)
    {
        return Permission::check(get_class($this->owner) . '_edit');
    }
    public function canDelete($member = false)
    {
        return Permission::check(get_class($this->owner) . '_delete');
    }
    public function canCreate($member = false)
    {
        return Permission::check(get_class($this->owner) . '_create');
    }

    /**
     * Get a complete list of all the permissions this class uses.
     */
    public function providePermissions()
    {
        $permissions = array();
        $config = Config::inst()->get('PublishProvider', 'classes');

        foreach ($config as $class) {
            $subClasses = array_keys(ClassInfo::subclassesFor($class));
            
            foreach ($subClasses as $subClass) {
                foreach (array(
                        'publish',
                        'unpublish',
                        'archive',
                        'view',
                        'edit',
                        'delete',
                        'create') as $name) {
                    $permissions[$subClass . '_' . $name] = singleton($subClass)->singular_name(). ' ' . $name;
                }
            }
        }
        
        return $permissions;
    }
}
